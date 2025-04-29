import { useEffect } from "react";

const DisableScroll = () => {
  useEffect(() => {
    document.body.style.overflow = "hidden"; // Disable scrolling

    return () => {
      document.body.style.overflow = "auto"; // Re-enable scrolling when the component is unmounted
    };
  }, []);

  return null; 
};

export default DisableScroll;
