import { Navigate, Outlet } from "react-router-dom";
import { useContext } from "react";
import { AuthContext } from "../context/AuthContext";

const AdminRoute = () => {
  const { user, loading } = useContext(AuthContext);

  if (loading) return <p>Loading...</p>; 
  return user && user.role_id === 1 ? <Outlet /> : <Navigate to="/unauthorized" />;
};

export default AdminRoute;
