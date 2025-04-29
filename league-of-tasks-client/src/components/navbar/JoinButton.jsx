import React from "react";
import { Button } from "react-bootstrap";
import { Link } from "react-router-dom";
import "./JoinButton.css";

const JoinButton = () => {
    return (
        <Button as={Link} to="/register" variant="light" className="btn-Join">
            Rejoindre League of Tasks
        </Button>
    );
};

export default JoinButton;
