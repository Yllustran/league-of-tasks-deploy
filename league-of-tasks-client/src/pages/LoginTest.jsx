import React, { useContext } from "react";
import { AuthContext } from "../context/AuthContext";
import { Link } from "react-router-dom";
import useAuth from "../hooks/useAuth";
import ProfileHeader from "../layouts/ProfileHeader";

const LoginTest = () => {
    const { user, loading } = useContext(AuthContext);
    const { logout } = useAuth();

    // Récupérer le JWT depuis localStorage
    const token = localStorage.getItem("token");

    return (
        <div className="container text-center mt-5">
            <ProfileHeader />
            <h1>Bienvenue {user ? user.username : "sur notre site"} !</h1>

            {loading ? (
                <p>Chargement...</p>
            ) : user ? (
                <div>
                    <p>Vous êtes connecté en tant que {user.username}.</p>
                    <p>Vous êtes au niveau : {user.level}.</p>

                    {/* Affichage du JWT */}
                    <div className="mt-3">
                        <h5> Le Token JWT :</h5>
                        <p className="text-break text-monospace bg-light p-2 border rounded">
                            {token ? token : "Aucun token trouvé"}
                        </p>
                    </div>

                    <button onClick={logout} className="btn btn-danger mt-3">Se déconnecter</button>
                </div>
            ) : (
                <p>
                    <Link to="/login" className="btn btn-primary">Se connecter</Link>
                </p>
            )}
        </div>
    );
};

export default LoginTest;
