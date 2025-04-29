import React, { useState } from "react";
import { Link } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import "../../pages/LoginPage.css";
import loginIcon from "../../assets/icons/auth-icon.png";
import LoginCard from "./LoginCard";
import LoginIcon from "./LoginIcon";
import TextInput from "./TextInput";
import PasswordInput from "./PasswordInput";
import SubmitButton from "./SubmitButton";
import useAuth from "../../hooks/useAuth";
import DisableScroll from "../DisableScroll";

const LoginForm = () => {
    const { login, loading, error, success } = useAuth();
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
        login(email, password);
    };

    return (
        <div className="login-container">
            <DisableScroll />
            <LoginCard>
                <LoginIcon src={loginIcon} />
                <h4 className="text-center mb-3">Se connecter</h4>

                <form onSubmit={handleSubmit}>
                    <TextInput label="Email" type="email" id="email" placeholder="Mon adresse email" value={email} onChange={(e) => setEmail(e.target.value)} />
                    <PasswordInput label="Mot de passe" id="password" value={password} onChange={(e) => setPassword(e.target.value)} />
                    <SubmitButton text={loading ? "Connexion..." : "Connexion"} disabled={loading} />
                </form>

                {error && <p className="text-danger text-center mt-2">{error}</p>}
                {success && <p className="text-success text-center mt-2">Connexion réussie !</p>}

                <div className="text-center mt-3">
                    <p className="text-small">
                        Tu n'as pas de compte ? <Link to="/register" className="text-small-link">S'inscrire ici</Link>
                    </p>
                </div>
            </LoginCard>
        </div>
    );
};

export default LoginForm;
