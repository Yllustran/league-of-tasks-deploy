import React, { createContext } from "react";
import useUserProfile from "../hooks/useUserProfile";
import useUserTasks from "../hooks/useUserTasks";
import useAvatar from "../hooks/useAvatar";
import apiService from "../services/apiService";

const UserContext = createContext();


export function UserProvider({ children }) {
  // Profile & XP 
  const {
    user,
    xp,
    xpNeeded,
    interests,
    avatarId,
    loading: profileLoading,
    error: profileError,
    progressXp,
    reloadProfile,
  } = useUserProfile();

  // Tasks 
  const {
    tasks,
    loading: tasksLoading,
    setTasks,
    reloadTasks,
  } = useUserTasks();

  // Avatar 
  const {
    avatarUrl,
    loading: avatarLoading,
    error: avatarError,
  } = useAvatar(avatarId);

  const loading = profileLoading || tasksLoading || avatarLoading;
  const error = profileError || avatarError;

  // Method to update the profile)
  const updateProfile = async (updatedInfo) => {
    try {
      await apiService.put("/user", updatedInfo);
      reloadProfile();
    } catch (err) {
      console.error("Error updating profile:", err);
    }
  };

  // Generate new tasks + reload the list of tasks
  const generateNewTasks = async () => {
    try {
      await apiService.post("/user/tasks/generate");
      // We immediately reload the list from the DB
      reloadTasks();
    } catch (err) {
      console.error("Error generating tasks:", err);
    }
  };

  // Complete tasks and update XP 
  const completeTaskInContext = async (taskId) => {
    try {
      await apiService.patch(`/user/tasks/${taskId}/complete`);
      reloadTasks();
      reloadProfile();
    } catch (error) {
      console.error("Error validating the task:", error);
    }
  }

  // Update the avatar
  const updateAvatarInContext = async (newAvatarId) => {
    try {
      await apiService.patch("/user/avatar", { avatar_id: newAvatarId });
      // Then, we re-fetch the profile to take the change into account
      reloadProfile();
    } catch (error) {
      console.error("Error updating the avatar:", error);
    }
  };

  return (
    <UserContext.Provider
      value={{
        // Profile data
        user,
        xp,
        xpNeeded,
        interests,
        avatarUrl,
        // Tasks
        tasks,
        setTasks,
        // Global state
        loading,
        error,
        progressXp,
        // Methods
        reloadProfile,
        generateNewTasks,
        completeTaskInContext,
        updateProfile,
        updateAvatarInContext, 
      }}
    >
      {children}
    </UserContext.Provider>
  );
}

export default UserContext;
