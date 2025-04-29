import React from "react";
import { ProgressBar } from "react-bootstrap";
import { FaCog } from "react-icons/fa";
import "./ProfileCard.css";
import AvatarSelector from "./AvatarSelector";
import { useNavigate } from 'react-router-dom';

const ProfileCard = ({ user, xp, xpNeeded, progressXp }) => {
    const navigate = useNavigate();
    const handleBackClick = () => {
        navigate('/profile/update'); 
      };
    return (
        <div className="profile-card shadow-sm text-center">
            <div className="profile-left">
                <AvatarSelector />
            </div>
            <div className="profile-right">
                <h3 className="profile-username">{user.username}</h3>
                <p className="profile-level">Level {user.level}</p>
                <FaCog className="settings-icon" onClick={handleBackClick} />
                <div className="xp-container">
                    <div className="xp-text">{xp} / {xpNeeded + xp} XP</div>
                    <ProgressBar now={progressXp} className="xp-bar" />
                </div>
            </div>
        </div>
    );
};

export default ProfileCard;