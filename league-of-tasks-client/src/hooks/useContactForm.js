import { useState } from "react";
import apiService from "../services/apiService";

const useContactForm = () => {
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [success, setSuccess] = useState(null);

    const sendContactForm = async (formData) => {
        setLoading(true);
        setError(null);
        setSuccess(null);

        try {
            const response = await apiService.post("/contacts", formData); // Vérifie bien l'URL
            setSuccess(response.data.message);
        } catch (err) {
            setError(err.response?.data?.message || "Une erreur est survenue.");
        } finally {
            setLoading(false);
        }
    };

    return { loading, error, success, setSuccess, sendContactForm }; 
};

export default useContactForm;
