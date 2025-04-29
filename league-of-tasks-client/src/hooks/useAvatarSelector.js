// hooks/useAvatarSelector.js
import { useState, useContext } from "react";
import useAvailableAvatars from "./useAvailableAvatars";
import UserContext from "../context/UserContext";

const useAvatarSelector = () => {
  const { user, updateAvatarInContext } = useContext(UserContext);
  const { avatars, loading } = useAvailableAvatars();
  const [isModalOpen, setIsModalOpen] = useState(false);

  const selectAvatar = async (avatarId) => {
    await updateAvatarInContext(avatarId);
    setIsModalOpen(false);
  };

  return {
    avatarId: user?.avatar_id,
    isModalOpen,
    setIsModalOpen,
    avatars,
    loading,
    selectAvatar,
  };
};

export default useAvatarSelector;
