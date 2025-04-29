import React, { useContext } from "react";
import { Nav } from "react-bootstrap";
import { Link } from "react-router-dom";
import JoinButton from "./JoinButton";
import { AuthContext } from "../../context/AuthContext"; 
import "./NavLink.css";

const NavLinks = () => {
  const { user, setUser } = useContext(AuthContext);

  const handleLogout = () => {
    localStorage.removeItem("token"); // delete JWT Token
    setUser(null); // update AuthContext
    window.location.href = "/"; // HomePage Redirection
  };

  return (
    <>
      <Nav.Link as={Link} to="/">Accueil</Nav.Link>
      <Nav.Link as={Link} to="/about">C’est quoi LoT?</Nav.Link>
      <Nav.Link as={Link} to="/faq">FAQ</Nav.Link>
      <Nav.Link as={Link} to="/contact">Contact</Nav.Link>

      {/* if the user is login (JWT) */}
      {user ? (
        <>
          <Nav.Link as={Link} to="/profile">Mon Profil</Nav.Link>
          <Nav.Link as={Link} to="/mytasks">Tâches du jour</Nav.Link>
          {user.role_id === 1 && <Nav.Link as={Link} to="/admin">Admin</Nav.Link>}
          <Nav.Link as="button" onClick={handleLogout} className="nav-link logout-button">
            Déconnexion
          </Nav.Link>
        </>
      ) : (
        <>
          <Nav.Link as={Link} to="/login">Connexion</Nav.Link>
          <JoinButton />
        </>
      )}
    </>
  );
};

export default NavLinks;
