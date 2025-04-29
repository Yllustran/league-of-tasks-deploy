import React, { useState } from "react";
import "./AvatarModal.css";
import useAvailableAvatars from "../../hooks/useAvailableAvatars";

const AvatarModal = ({ isOpen, onClose, onSelectAvatar }) => {
  const { avatars, loading, error } = useAvailableAvatars();
  const [selectedAvatarId, setSelectedAvatarId] = useState(null);

  const handleSelectAvatar = (avatarId) => {
    setSelectedAvatarId(avatarId);
    onSelectAvatar(avatarId);
  };

  return (
    <div
      className={`modal-overlay ${isOpen ? "open" : ""}`}
      onClick={onClose}
    >
      <div className="modal-content" onClick={(e) => e.stopPropagation()}>
        <h2>CHOISISSEZ UN AVATAR</h2>

        {loading ? (
          <p>Chargement des avatars...</p>
        ) : error ? (
          <p>{error?.message}</p>
        ) : (
          <div className="avatar-grid">
            {avatars.map((avatar) => (
              <img
                key={avatar.id}
                src={avatar.avatar_url}
                alt={avatar.avatar_name}
                className={`avatar-option ${
                  selectedAvatarId === avatar.id ? "selected" : ""
                }`}
                onClick={() => handleSelectAvatar(avatar.id)}
              />
            ))}
          </div>
        )}

        <button className="close-btn" onClick={onClose}>
          Fermer
        </button>
      </div>
    </div>
  );
};

export default AvatarModal;
