import React from "react";
import { Card } from "react-bootstrap";
import "./Inclusivity.css";

const Inclusivity = ({ user }) => {
    const inclusivityOptions = [];

    if (user.physical_disabled && user.physical_disabled !== 0) {
        inclusivityOptions.push("Mobilité réduite");
    }

    if (user.vision_impairment && user.vision_impairment !== 0) {
        inclusivityOptions.push("Accessibilité visuelle");
    }

    return (
        <div className="container-inclusivity">
            <Card className="inclusivity-card shadow-sm">
                <h5 className="section-title">Paramètres d’inclusivité</h5>
            </Card>
            <div className="inclusivity-content">
                {inclusivityOptions.length > 0 ? (
                    <ul className="mt-2">
                        {inclusivityOptions.map((option, index) => (
                            <li className="inclusivity-param"key={index}>{option} ✔️</li>
                        ))}
                    </ul>
                ) : (
                    <p className="text-muted text-center">
                        Vous n’avez renseigné aucune contrainte d’accessibilité.
                    </p>
                )}
            </div>
        </div>
    );
};

export default Inclusivity;
