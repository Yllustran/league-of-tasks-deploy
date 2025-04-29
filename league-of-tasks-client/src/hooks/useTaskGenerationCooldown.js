import { useState, useContext } from "react";
import UserContext from "../context/UserContext";

const useTaskGenerationCooldown = (delay = 1 * 60 * 10) => {
  const [isDisabled, setIsDisabled] = useState(false);
  const [isLoading, setIsLoading] = useState(false);

  const { generateNewTasks } = useContext(UserContext);

  const generateTasks = async () => {
    if (isDisabled) return;
    setIsLoading(true);

    try {
      await generateNewTasks();
      localStorage.setItem("lastTaskGeneration", Date.now().toString());
      setIsDisabled(true);
    } catch (error) {
      console.error("Erreur de génération:", error);
    } finally {
      setIsLoading(false);
    }
  };

  return { isDisabled, isLoading, generateTasks };
};

export default useTaskGenerationCooldown;
