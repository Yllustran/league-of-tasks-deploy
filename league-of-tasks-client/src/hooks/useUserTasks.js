import { useState, useEffect } from "react";
import apiService from "../services/apiService";

const useUserTasks = () => {
  const [tasks, setTasks] = useState([]);
  const [loading, setLoading] = useState(true);

  // Internal function to GET /user/tasks
  const fetchTasks = async () => {
    try {
      const response = await apiService.get("/user/tasks");
      setTasks(response.data);
    } catch (error) {
      console.error("Error loading tasks:", error);
    } finally {
      setLoading(false);
    }
  };

  // Load tasks on mount
  useEffect(() => {
    fetchTasks();
  }, []);

  const reloadTasks = () => {
    setLoading(true);
    fetchTasks();
  };

  return {
    tasks,
    loading,
    setTasks,
    reloadTasks, 
  };
};

export default useUserTasks;
