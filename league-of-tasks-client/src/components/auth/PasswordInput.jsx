import React, { useState } from "react";
import "./PasswordInput.css"; 

const PasswordInput = ({ label, id, value, onChange }) => {
  const [showPassword, setShowPassword] = useState(false);

  return (
    <div className="password-input-container">
      <label htmlFor={id} className="form-label">{label}</label>
      <div className="input-group">
        <input
          type={showPassword ? "text" : "password"}
          className="form-control password-input"
          id={id}
          placeholder="Mon mot de passe"
          value={value} 
          onChange={onChange} 
          required
        />
        <span
          className="input-group-text password-toggle"
          onClick={() => setShowPassword(!showPassword)}>
          <i className={showPassword ? "bi bi-eye-slash" : "bi bi-eye"}></i>
        </span>
      </div>
    </div>
  );
};

export default PasswordInput;
