import React from "react";
import { Badge } from "react-bootstrap";
import "./Interests.css";

const Interests = ({ interests }) => {
    return (
        <div className="container-interests">
            <div className="interests-card shadow-sm">
                <h5 className="section-title">Mes centres d’intérêts</h5>
            </div>
            <div className="interest-list mt-2">
                {interests.length > 0 ? (
                    interests.map((interest, index) => (
                        <Badge key={index} className="interest-badge">
                            {interest.interest_name}
                        </Badge>
                    ))
                ) : (
                    <p className="text-muted text-center">Aucun centre d’intérêt renseigné.</p>
                )}
            </div>
        </div>
    );
};

export default Interests;
