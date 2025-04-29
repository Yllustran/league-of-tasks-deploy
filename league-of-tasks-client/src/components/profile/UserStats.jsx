import React from "react";
import { Row, Col, Card } from "react-bootstrap";
import "./UserStats.css";

const UserStats = ({ user }) => {
    return (
        <Row className="profile-stats">
            <Col xs={4}>
                <Card className="stat-card task">
                    <p className="stat-label">Tâches ✔️</p>
                    <h5 className="stat-value">{user.task_season}</h5>
                </Card>
            </Col>
            <Col xs={4}>
                <Card className="stat-card gold">
                    <p className="stat-label">Mes Golds</p>
                    <h5 className="stat-value">{user.gold}</h5>
                </Card>
            </Col>
            <Col xs={4}>
                <Card className="stat-card reroll">
                    <p className="stat-label">Mes Rerolls</p>
                    <h5 className="stat-value">0</h5>
                </Card>
            </Col>
        </Row>
    );
};

export default UserStats;
