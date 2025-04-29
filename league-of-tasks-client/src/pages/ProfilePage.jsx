import React from "react";
import { Container } from "react-bootstrap";
import useUserProfile from "../hooks/useUserProfile";
import ProfileCard from "../components/profile/ProfileCard";
import UserStats from "../components/profile/UserStats";
import Interests from "../components/profile/Interests";
import Inclusivity from "../components/profile/Inclusivity";
import "./ProfilePage.css";

const ProfilePage = () => {
    const { user, xp, xpNeeded, progressXp, interests, error } = useUserProfile();

    if (error || !user) {
        return 
    }

    return (
        <div className="fullcontainer">
            <Container className="profile-container mt-4">
                <ProfileCard user={user} xp={xp} xpNeeded={xpNeeded} progressXp={progressXp} />
                <UserStats user={user} />
                <Interests interests={interests} />
                <Inclusivity user={user} />
            </Container>
        </div>
    );
};

export default ProfilePage;
