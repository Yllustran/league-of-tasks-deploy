import React from "react";

const TextInput = ({ label, id, type, placeholder, value, onChange }) => {
  return (
    <div className="mb-3">
      <label htmlFor={id} className="form-label">{label}</label>
      <input 
        type={type} 
        className="form-control" 
        id={id} 
        placeholder={placeholder} 
        value={value} 
        onChange={onChange} 
        required
        style={{ fontSize: "1rem", padding: "10px" }}
      />
    </div>
  );
};

export default TextInput;
