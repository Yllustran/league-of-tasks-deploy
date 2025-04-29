import React from "react";
 import "./FullPageLoader.css";
 import loaderImage from "../../assets/icons/auth-icon.png";
 
 const FullPageLoader = () => {
   return (
     <div className="full-page-loader">
       <img src={loaderImage} alt="Chargement..." />
     </div>
   );
 };
 
 export default FullPageLoader;