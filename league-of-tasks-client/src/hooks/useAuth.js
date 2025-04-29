import { useState, useContext } from "react";
import api from "../services/apiService";
import { useNavigate } from "react-router-dom";
import { AuthContext } from "../context/AuthContext";

const useAuth = () => {
  const { setUser } = useContext(AuthContext);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const navigate = useNavigate();


  // Login 
  const login = async (email, password) => {
    setLoading(true);
    setError(null);

    try {
      const response = await api.post("/login", { email, password });
      localStorage.setItem("token", response.data.token);

      const profileResponse = await api.get("/profile");
      setUser(profileResponse.data);

      navigate("/profile");
    } catch (err) {
      setError(err.response?.data?.error || "Erreur de connexion");
    } finally {
      setLoading(false);
    }
  };

  // Logout
  const logout = async () => {
    try {
      await api.post("/logout"); // Invalidate token
    } catch (err) {
      console.error("Logout error:", err);
    }

    localStorage.removeItem("token");
    setUser(null);
    navigate("/login");
  }

  // Register
  const register = async (username, email, password, confirmPassword, physicalDisabled, visionImpairment, selectedInterests) => {
    setLoading(true);
    setError(null);

    if (password !== confirmPassword) {
        setError("Les mots de passe ne correspondent pas.");
        setLoading(false);
        return;
    }

    try {
        const response = await api.post("/register", {
            username,
            email,
            password,
            physical_disabled: physicalDisabled,
            vision_impairment: visionImpairment,
            interests: selectedInterests, 
        });

        localStorage.setItem("token", response.data.token);
        const profileResponse = await api.get("/profile");
        setUser(profileResponse.data);

        navigate("/logintest");
    } catch (err) {
        setError(err.response?.data?.error || "Erreur lors de l'inscription");
    } finally {
        setLoading(false);
    }
};

  return { login, logout, register, loading, error };
};

export default useAuth;