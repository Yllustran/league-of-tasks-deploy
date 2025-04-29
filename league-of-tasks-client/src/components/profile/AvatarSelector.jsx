import React from "react";
import AvatarModal from "./AvatarModal";
import useAvatarSelector from "../../hooks/useAvatarSelector";
import UserAvatar from "./UserAvatar"; 
import "./AvatarModal.css";

const AvatarSelector = () => {
    const { avatarId, isModalOpen, setIsModalOpen, selectAvatar } = useAvatarSelector();

    return (
        <div className="avatar-container">
            {/* Show current clicked avatar  */}
            <div onClick={() => setIsModalOpen(true)} className="avatar-clickable">
                <UserAvatar avatarId={avatarId} />
            </div>

            {/* Modal : select a new avatar */}
            {isModalOpen && (
                <AvatarModal
                    isOpen={isModalOpen}
                    onClose={() => setIsModalOpen(false)}
                    onSelectAvatar={selectAvatar}
                />
            )}
        </div>
    );
};

export default AvatarSelector;
