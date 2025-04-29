import { useState, useEffect, useCallback } from "react";
import { getUserProfile, getUserProgress, getUserInterests } from "../services/userService";

const useUserProfile = () => {
    const [profileData, setProfileData] = useState({
        user: null,
        xp: 0,
        xpNeeded: 100,
        interests: [],
        avatarId: null,
        loading: true,
        error: null,
    });

    const [refreshKey, setRefreshKey] = useState(0);

    const fetchUserData = useCallback(async () => {
        setProfileData((prev) => ({ ...prev, loading: true }));
        
        try {
            // We Retrieve user, progress & interests
            const [userData, progressData, interestsData] = await Promise.all([
                getUserProfile(),
                getUserProgress(),
                getUserInterests(),
            ]);

            // We stock directly avatarId = userData.avatar_id
            setProfileData({
                user: userData,
                xp: progressData.xp,
                xpNeeded: progressData.xp_needed_for_next_level,
                interests: interestsData,
                avatarId: userData.avatar_id, 
                loading: false,
                error: null,
            });
        } catch (err) {
            setProfileData((prev) => ({
                ...prev,
                loading: false,
                error: err,
            }));
        }
    }, []);

    // We execute fetchUserData on mount and each time refreshKey changes
    useEffect(() => {
        fetchUserData();
    }, [fetchUserData, refreshKey]);

    // To force reloading data (in case of a profile update, etc.)
    const reloadProfile = () => setRefreshKey((prev) => prev + 1);

    // Calculate the progress percentage
    const totalXP = profileData.xp + profileData.xpNeeded;
    const progressXp = Math.min(100, (profileData.xp / totalXP) * 100);

    return {
        ...profileData, // user, xp, xpNeeded, interests, avatarId, loading, error
        progressXp,
        reloadProfile
    };
};

export default useUserProfile;
