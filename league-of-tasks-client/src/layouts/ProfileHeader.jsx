import React, { useContext } from "react";
import { Container } from "react-bootstrap";
import UserContext from "../context/UserContext";
import ProfileCard from "../components/profile/ProfileCard";
import "../pages/ProfilePage.css";

const ProfileHeader = () => {
    const { user, xp, xpNeeded, progressXp, error } = useContext(UserContext);

    if (error || !user) {
        return 
    }

    return (
        <Container className="profile-container mt-4">
            <ProfileCard
                user={user}
                xp={xp}
                xpNeeded={xpNeeded}
                progressXp={progressXp}
            />
        </Container>
    );
};

export default ProfileHeader;
