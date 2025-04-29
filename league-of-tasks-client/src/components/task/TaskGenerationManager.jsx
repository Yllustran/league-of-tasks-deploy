import React from "react";
import useTaskGenerationCooldown from "../../hooks/useTaskGenerationCooldown";
import './GenerateTasksButton.css'

const TaskGenerationManager = () => {
  const { isDisabled, isLoading, generateTasks } = useTaskGenerationCooldown();

  return (
    <div className="task-manager-container">
      {isDisabled ? (
        <div className="task-box">MES TASKS</div>
      ) : (
        <button onClick={generateTasks} disabled={isLoading} className="generate-tasks-btn">
          {isLoading ? "Génération en cours..." : "Découvrir mes tâches du jour"}
        </button>
      )}
    </div>
  );
};

export default TaskGenerationManager;
