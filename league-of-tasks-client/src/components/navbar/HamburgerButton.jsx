import React from "react";
import "./HamburgerButton.css"; 

const HamburgerButton = ({ expanded, setExpanded }) => {
  return (
    <button
      className={`hamburger-btn ${expanded ? "opened" : ""}`}
      onClick={() => setExpanded(!expanded)}
      aria-label="Toggle navigation"
    >
      <div className="burger-bar"></div>
      <div className="burger-bar"></div>
      <div className="burger-bar"></div>
    </button>
  );
};

export default HamburgerButton;
