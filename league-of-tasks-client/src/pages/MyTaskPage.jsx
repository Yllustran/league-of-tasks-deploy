import React from 'react';
import ProfileHeader from '../layouts/ProfileHeader';
import TaskGenerationManager from '../components/task/TaskGenerationManager';
import UserTasksList from '../components/task/UserTasksList';

const MyTaskPage = () => {
    return (
        <div>
            <ProfileHeader />
            <TaskGenerationManager />
            <UserTasksList />
        </div>
    );
};

export default MyTaskPage;