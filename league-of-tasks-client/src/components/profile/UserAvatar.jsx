import React, { useContext } from "react";
import UserContext from "../../context/UserContext";
import "./UserAvatar.css";

const UserAvatar = () => {
    const { avatarUrl, error } = useContext(UserContext);

    return (
        <div>
            {error && <p className="text-danger">{error}</p>}
            {avatarUrl && (
                <img
                    src={avatarUrl}
                    alt="User Avatar"
                    className="user-avatar"
                />
            )}
        </div>
    );
};

export default UserAvatar;
