import React, { useState, useContext } from "react";
import { ListGroup, Form } from "react-bootstrap";
import UserContext from "../../context/UserContext";
import './UserTasksList.css'

const UserTasksList = () => {
  // We retrieve tasks & loading from the UserContext
  const { tasks, completeTaskInContext } = useContext(UserContext);
  // Local state to indicate if a task is being completed
  const [completeLoading, setCompleteLoading] = useState(false);

  // Function to validate a task (called when the checkbox is checked)
  const handleCompleteTask = async (taskId) => {
    setCompleteLoading(true);
    await completeTaskInContext(taskId);
    setCompleteLoading(false);
  };

  return (
    <div className="task-container">
        <ListGroup className="task-list">
          {tasks.map((task) => (
            <div
              key={task.id}
              className={`task-item ${
                task.is_completed === 1 ? "completed-task" : ""
              }`}
            >
              <p className="task-text">{task.task_name}</p>
              <Form.Check
                type="checkbox"
                checked={task.is_completed === 1}
                // Disabled if already completed or if we are in the process of completion
                disabled={task.is_completed === 1 || completeLoading}
                onChange={() => handleCompleteTask(task.id)}
                className="custom-checkbox"
              />
            </div>
          ))}
        </ListGroup>
    </div>
  );
};

export default UserTasksList;
