import React, { useState, useEffect } from "react";
import useUserProfile from "../../hooks/useUserProfile";
import { getUserInterests, fetchAllInterests, updateUserProfile } from "../../services/userService";
import SubmitButton from "../auth/SubmitButton";
import './ProfileUpdateForm.css';
import { FaArrowLeft } from "react-icons/fa";
import { useNavigate } from 'react-router-dom';

const ProfileUpdateForm = () => {
    const { user, reloadProfile } = useUserProfile();
    const [physicalDisabled, setPhysicalDisabled] = useState(false);
    const [visionImpairment, setVisionImpairment] = useState(false);
    const [selectedInterests, setSelectedInterests] = useState([]);
    const [allInterests, setAllInterests] = useState([]);
    const [loading, setLoading] = useState(false);
    const [successMessage, setSuccessMessage] = useState("");
    const [errorMessage, setErrorMessage] = useState("");
    const navigate = useNavigate();

    // Load ALL interests + user interests
    useEffect(() => {
        const fetchInterests = async () => {
            try {
                const allInterestsData = await fetchAllInterests();
                const userInterestsData = await getUserInterests();
                
                setAllInterests(allInterestsData);
                setSelectedInterests(userInterestsData.map(i => i.id));
            } catch (error) {
                setErrorMessage("Impossible de récupérer les centres d'intérêts.");
            }
        };
        fetchInterests();
    }, []);

    // Load user's inclusivity params
    useEffect(() => {
        if (user) {
            setPhysicalDisabled(user.physical_disabled ?? false);
            setVisionImpairment(user.vision_impairment ?? false);
        }
    }, [user]);

    // select / unselect interests
    const handleInterestClick = (interestId) => {
        setSelectedInterests((prev) =>
            prev.includes(interestId) ? prev.filter(id => id !== interestId) : [...prev, interestId]
        );
    };

    // submit the form
    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setSuccessMessage("");
        setErrorMessage("");

        try {
            await updateUserProfile(
                { physical_disabled: physicalDisabled, vision_impairment: visionImpairment },
                selectedInterests
            );
            setSuccessMessage("Profil mis à jour avec succès !");
            reloadProfile();
        } catch {
            setErrorMessage("Impossible de mettre à jour votre profil. Veuillez réessayer.");
        } finally {
            setLoading(false);
        }
    };

    const handleBackClick = () => {
        navigate('/profile'); 
    };

    return (
        <div className="update-profile-container">
            <div className="arrow-separator">
                <FaArrowLeft className="back-arrow-update" onClick={handleBackClick} />
                <h2 className="update_h2">Modifier mon profil</h2>
            </div>

            {successMessage && <p className="success-message">{successMessage}</p>}
            {errorMessage && <p className="error-message">{errorMessage}</p>}

            <form onSubmit={handleSubmit}>
                {/* inclusivity params */}
                <div className="form-group">
                    <div className="form-group-title">
                        <h3 className="update_h3">Mes paramètres d'accessibilité</h3>
                        <hr className="simple_hr" />
                    </div>
                    <div className="Accessibility-check">
                        <input type="checkbox" id="physicalDisabled"
                               checked={physicalDisabled}
                               onChange={(e) => setPhysicalDisabled(e.target.checked)} />
                        <label htmlFor="physicalDisabled"> Je suis une personne à mobilité réduite</label>
                    </div>

                    <div className="Accessibility-check">
                        <input type="checkbox" id="visionImpairment"
                               checked={visionImpairment}
                               onChange={(e) => setVisionImpairment(e.target.checked)} />
                        <label htmlFor="visionImpairment">J'ai des besoins en accessibilité visuelle</label>
                    </div>
                </div>

                {/* Select interests */}
                <div className="form-group">
                    <div className="form-group-title">
                        <h3 className="update_h3">Mes centres d'intérêt</h3>
                        <hr className="simple_hr" />
                    </div>
                    <div className="interests-container">
                        {allInterests.map((interest) => (
                            <div key={interest.id}
                                 className={`interest-badge ${selectedInterests.includes(interest.id) ? "selected" : ""}`}
                                 onClick={() => handleInterestClick(interest.id)}>
                                {interest.interest_name}
                            </div>
                        ))}
                    </div>
                </div>

                <SubmitButton text={loading ? "Mise à jour..." : "Enregistrer les modifications"} disabled={loading} />
            </form>
        </div>
    );
};

export default ProfileUpdateForm;
