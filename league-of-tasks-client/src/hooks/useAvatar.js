import { useState, useEffect } from "react";
import api from "../services/apiService";

const useAvatar = (avatarId) => {
  const [avatarUrl, setAvatarUrl] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    if (!avatarId) return;
    let isCancelled = false;

    const fetchAvatar = async () => {
      try {
        setLoading(true);
        const response = await api.get(`/avatars/${avatarId}`);

        let apiUrl = process.env.REACT_APP_API_URL.replace(/\/api$/, "");
        let fullAvatarUrl = response.data.avatar_url.startsWith("http")
          ? response.data.avatar_url
          : `${apiUrl}/${response.data.avatar_url}`;

        if (!isCancelled) {
          setAvatarUrl(fullAvatarUrl);
        }
      } catch (err) {
        console.error("Erreur lors du chargement de l'avatar :", err);
        if (!isCancelled) {
          setError("Impossible de charger l'avatar.");
        }
      } finally {
        if (!isCancelled) {
          setLoading(false);
        }
      }
    };

    fetchAvatar();

    return () => {
      isCancelled = true;
    };
  }, [avatarId]);

  return { avatarUrl, loading, error };
};

export default useAvatar;
