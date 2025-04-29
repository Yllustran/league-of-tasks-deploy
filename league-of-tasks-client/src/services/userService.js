import apiService from "./apiService";

// Retrieves user profil information 
export const getUserProfile = async () => {
    try {
        const response = await apiService.get("/profile");
        return response.data;
    } catch (error) {
        console.error("Erreur lors du chargement du profil :", error);
        throw error;
    }
};

// Retrieve User Xp Progress Récupère 
export const getUserProgress = async () => {
    try {
        const response = await apiService.get("/user/progress");
        return response.data;
    } catch (error) {
        console.error("Erreur lors du chargement de la progression :", error);
        throw error;
    }
};

// Retriev User Interests
export const getUserInterests = async () => {
    try {
        const response = await apiService.get("/user/interests");
        return response.data;
    } catch (error) {
        console.error("Erreur lors du chargement des intérêts :", error);
        throw error;
    }
};

// Update interests & inclusivity params
export const updateUserProfile = async (accessibility, interests) => {
    try {
        // update inclusivity params
        await apiService.put("/user/accessibility", accessibility);

        // update user interests (replace all)
        const response = await apiService.put("/user/interests", {
            interest_ids: interests,
            replace: true,
        });

        return response.data;
    } catch (error) {
        console.error("Erreur lors de la mise à jour du profil :", error);
        throw error;
    }
};

// Retrieve ALL interets 
export const fetchAllInterests = async () => {
    try {
        const response = await apiService.get("/interests");
        return response.data;
    } catch (error) {
        console.error("Erreur lors du chargement de tous les intérêts :", error);
        throw error;
    }
};
