import React from "react";
import "./CustomButton.css";

const SubmitButton = ({ text }) => {
  return <button type="submit" className="btn custom-btn w-100">{text}</button>;
};

export default SubmitButton;