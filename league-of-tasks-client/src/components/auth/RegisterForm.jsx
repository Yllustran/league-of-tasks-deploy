import React, { useState, useEffect } from "react";
import { FaArrowLeft } from "react-icons/fa";
import LoginCard from "./LoginCard";
import TextInput from "./TextInput";
import PasswordInput from "./PasswordInput";
import SubmitButton from "./SubmitButton";
import useAuth from "../../hooks/useAuth";
import LoginIcon from "./LoginIcon";
import loginIcon from "../../assets/icons/auth-icon.png";
import "./RegisterForm.css";
import AccessibilityTooltip from "../tooltip/AccessibilityTooltip";
import DisableScroll from "../DisableScroll";
import api from "../../services/apiService";

const RegisterForm = () => {
    const { register, loading } = useAuth();

    // Form field states
    const [username, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");
    const [physicalDisabled, setPhysicalDisabled] = useState(false);
    const [visionImpairment, setVisionImpairment] = useState(false);
    const [step, setStep] = useState(1);

    // Error State
    const [errors, setErrors] = useState({});

    // Interests state 
    const [interests, setInterests] = useState([]);
    const [selectedInterests, setSelectedInterests] = useState([]);

    // retrieve interests from api
    useEffect(() => {
        api.get("/interests")
            .then(response => setInterests(response.data))
            .catch(error => console.error("Erreur lors du chargement des intérêts :", error));
    }, []);

    // Password format verification
    const isPasswordValid = (pwd) => {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        return passwordRegex.test(pwd);
    };

    // function for validate all form step
    const validateForm = () => {
        let newErrors = {};

        // Validation for step 1 : Username & Email
        if (step === 1) {
            if (!username.trim()) newErrors.username = "Le nom d'utilisateur est requis.";
            if (!email.trim()) newErrors.email = "L'email est requis.";
            else if (!/\S+@\S+\.\S+/.test(email)) newErrors.email = "Format d'email invalide.";
        }

        // Validation for step 2 : Password
        if (step === 2) {
            if (!password.trim()) newErrors.password = "Le mot de passe est requis.";
            else if (!isPasswordValid(password)) newErrors.password = "8 caractères minimum : 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.";
            if (!confirmPassword.trim() || password !== confirmPassword) newErrors.confirmPassword = "Les mots de passe ne correspondent pas.";
        }

        // Validate interests (both step 4 and final submission)
        if (step === 4 || step === 5) {
            if (selectedInterests.length < 3) {
                newErrors.interests = "Veuillez sélectionner au moins 3 centres d’intérêt.";
            }
        }

        return newErrors;
    };

    // Select / Unselect interests 
    const toggleInterest = (interestId) => {
        setSelectedInterests((prev) =>
            prev.includes(interestId) ? prev.filter((id) => id !== interestId) : [...prev, interestId]
        );
    };

    // Function to validate and proceed to the next step  
    const validateStep = () => {
        const newErrors = validateForm();
        setErrors(newErrors);

        // Proceed only if no errors  
        if (Object.keys(newErrors).length === 0) {
            setStep(step + 1);
        }
    };

    // Function to submit the form  
    const handleSubmit = (e) => {
        e.preventDefault();

        // Final form validation  
        const finalErrors = validateForm();
        setErrors(finalErrors);

        if (Object.keys(finalErrors).length === 0) {
            register(username, email, password, confirmPassword, physicalDisabled, visionImpairment, selectedInterests);
        }
    };


    return (
        <div className="login-container">
            <DisableScroll />
            <LoginCard>
                {/* Container for align arrow and auth-icon  */}
                <div className="header-container">
                    {step > 1 && (
                        <FaArrowLeft className="back-arrow" onClick={() => setStep(step - 1)} />
                    )}
                    <LoginIcon src={loginIcon} />
                </div>

                <h4 className="text-center mb-3 join-h4"> Rejoindre <br /> League of Tasks </h4>

                <form onSubmit={handleSubmit}>
                    {/* Step 1 : Username & Email */}
                    {step === 1 && (
                        <>
                            <TextInput
                                label="Nom d'utilisateur" id="username" type="text"
                                placeholder="Mon nom" value={username}
                                onChange={(e) => setUsername(e.target.value)}
                            />
                            {errors.username && <p className="error-message">{errors.username}</p>}

                            <TextInput
                                label="Email" id="email" type="email"
                                placeholder="Mon adresse email" value={email}
                                onChange={(e) => setEmail(e.target.value)}
                            />
                            {errors.email && <p className="error-message">{errors.email}</p>}

                            <button type="button" className="next-btn mt-3" onClick={validateStep} disabled={loading}>
                                Suivant
                            </button>
                        </>
                    )}

                    {/* Step 2 : Password */}
                    {step === 2 && (
                        <>
                            <PasswordInput
                                label="Mot de passe" id="password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                            />
                            {errors.password && <p className="error-message">{errors.password}</p>}

                            <PasswordInput
                                label="Confirmer le mot de passe" id="confirmPassword"
                                value={confirmPassword}
                                onChange={(e) => setConfirmPassword(e.target.value)}
                            />
                            {errors.confirmPassword && <p className="error-message">{errors.confirmPassword}</p>}

                            <button type="button" className="next-btn mt-3" onClick={validateStep} disabled={loading}>
                                Suivant
                            </button>
                        </>
                    )}

                    {/* Step 3 : Accessibilites params */}
                    {step === 3 && (
                        <>
                            <div className="flex items-center justify-between mb-3">
                                <span className="text-lg font-medium">Paramètres d'accessibilité</span>
                                {/* Accessibility Tooltips component */}
                                <AccessibilityTooltip />
                            </div>

                            <div className="form-check accessibilities">
                                <input type="checkbox" className="form-check-input custom-checkbox"
                                    id="physicalDisabled" checked={physicalDisabled}
                                    onChange={(e) => setPhysicalDisabled(e.target.checked)}
                                />
                                <label className="form-check-label" htmlFor="physicalDisabled">
                                    Je suis une personne à mobilité réduite
                                </label>
                            </div>

                            <div className="form-check accessibilities">
                                <input type="checkbox" className="form-check-input custom-checkbox"
                                    id="visionImpairment" checked={visionImpairment}
                                    onChange={(e) => setVisionImpairment(e.target.checked)}
                                />
                                <label className="form-check-label" htmlFor="visionImpairment">
                                    J'ai des besoins en accessibilité visuelle
                                </label>
                            </div>

                            <button type="button" className="next-btn mt-3" onClick={validateStep} disabled={loading}>
                                Suivant
                            </button>
                        </>
                    )}

                    {/* Step 4 : Select Interests */}
                    {step === 4 && (
                        <>
                            <h5>Choisissez vos centres d'intérêt :</h5>
                            <div className="interests-container">
                                {interests.map((interest) => (
                                    <div
                                        key={interest.id}
                                        className={`interest-badge ${selectedInterests.includes(interest.id) ? "selected" : ""}`}
                                        onClick={() => toggleInterest(interest.id)}
                                    >
                                        {interest.interest_name}
                                    </div>
                                ))}
                            </div>

                            {errors.interests && <p className="error-message">{errors.interests}</p>}

                            <SubmitButton text={loading ? "Inscription..." : "Créer mon compte"} disabled={loading} />
                        </>
                    )}
                </form>
            </LoginCard>
        </div>
    );
};

export default RegisterForm;
