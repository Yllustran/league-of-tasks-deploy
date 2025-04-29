import { createContext, useState, useEffect } from "react";
import api from "../services/apiService";

// Create auth context
export const AuthContext = createContext(null);

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null); // Store user data
  const [loading, setLoading] = useState(true); // Track loading state

  useEffect(() => {
    const fetchProfile = async () => {
      const token = localStorage.getItem("token"); // Get token from storage
      if (!token) {
        setLoading(false); // No token, stop loading
        return;
      }

      try {
        const response = await api.get("/profile"); // Fetch user data
        setUser(response.data); // Save user data
      } catch (err) {
        console.error("Error fetching profile", err);
        localStorage.removeItem("token"); // Remove invalid token
        setUser(null); // Reset user
      } finally {
        setLoading(false); // Done loading
      }
    };

    fetchProfile();
  }, []);

  return (
    <AuthContext.Provider value={{ user, setUser, loading }}>
      {children}
    </AuthContext.Provider>
  );
};

export const logoutUser = () => {
  localStorage.removeItem("token"); // Supprime le token JWT
  window.location.href = "/login"; // Redirige vers la page de connexion
};
