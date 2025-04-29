import { useState, useEffect } from "react";
import apiService from "../services/apiService";

const useAvailableAvatars = () => {
    const [avatars, setAvatars] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchAvatars();
    }, []);

    const fetchAvatars = async () => {
        setLoading(true);
        const response = await apiService.get("/avatars/available");

        let apiUrl = process.env.REACT_APP_API_URL.replace(/\/api$/, "");

        const formattedAvatars = response.data.map(avatar => ({
            ...avatar,
            avatar_url: avatar.avatar_url.startsWith("http")
                ? avatar.avatar_url
                : `${apiUrl}/${avatar.avatar_url}`
        }));

        setAvatars(formattedAvatars);
        setLoading(false);
    };

    return { avatars, loading, refetch: fetchAvatars };
};

export default useAvailableAvatars;
