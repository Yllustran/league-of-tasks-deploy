import React from 'react';
import './BlocOne.css';
import CatImage from '../../assets/icons/avatar-greens.png';

function BlocOne() {
    return (
        <div className='green-main-container'>
            <div className="container py-5">
                <div className=" mb-4 div-title">
                    <h1 className="display-4 dark-primary">
                        BIENVENUE SUR <span className="light-green-span">LEAGUE OF TASK</span>
                    </h1>
                </div>

                <div className="mb-5 subtitle">
                    <h2 className='dark-primary'>
                        Simple & <span className='green-span'>Ludique</span>.
                    </h2>
                </div>

                <div className="row align-items-center">
                    {/* Image */}
                    <div className="col-12 col-md-6 text-center">
                        <img src={CatImage} alt="Motivation" className="responsive-img" />
                    </div>

                    <div className="col-12 col-md-6">
                        <div className="card-container">
                            <p>1. Accomplissez vos tâches. <br></br>Chaque jour, recevez 3 tâches aléatoires adaptées à vos préférences.</p>
                        </div>
                        <div className="card-container">
                            <p>2. Gagnez XP et Golds. <br></br>Chaque tâche complétée vous rapproche du niveau supérieur.</p>
                        </div>
                        <div className="card-container">
                            <p>3. Montez dans les ligues <br></br>Affrontez d’autres joueurs & progressez dans les ligues.</p>
                        </div>
                    </div>
                </div>

                <div className="text-center mt-4">
                    <button className="btn primary-cta-btn btn-lg">Rejoindre League Of Tasks</button>
                </div>

            </div>
        </div>
    );
}

export default BlocOne;
