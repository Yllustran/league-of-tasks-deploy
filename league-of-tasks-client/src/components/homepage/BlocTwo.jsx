import React from 'react';
import './BlocTwo.css';

function BlocTwo() {
    return (
        <div className='blue-main-container'>
            <div className="container py-5">

                <div className="text-center mb-4">
                    <h1 className="title">
                    Plus qu’une to-do list.
                    </h1>
                </div>

                <div className="text-center mb-5">
                    <h2 className='subtitle'>
                        La gamification <span className='green-span'>à votre SERVICE</span>
                    </h2>
                </div>

                <div className="text-container">
                    <p className='big-text'> Fini la surcharge mentale, place à l’efficacité. </p>
                    <p>
                    Chaque jour, votre to-do list s’allonge, et vous ne savez plus par où commencer. Résultat ?
                    Vous procrastinez, perdez du temps et voyez votre motivation s’effriter. <br />Nous avons la solution.
                    </p>
                    <p>
                        Notre approche repose sur un principe fondamental : <span className='bold-span'>la clarté.</span> <br />
                        Au lieu de jongler avec des dizaines de priorités, vous vous concentrez sur trois tâches essentielles par jour.  
                        Ce chiffre n’a rien d’anodin. Il est scientifiquement prouvé que limiter ses objectifs permet de les accomplir plus efficacement.  
                        <br /> <span className='bold-span'>Moins de stress, plus d’accomplissement.</span>
                    </p>
                    <p className='big-text'> Une approche simple et puissante : 3 tâches par jour. </p>
                    <p>
                        Plutôt que de jongler avec une liste interminable, League of tasks vous aide à vous concentrer sur l’essentiel : <br /><span className='bold-span'>trois actions clés chaque jour.</span> <br /><br />Ce chiffre n’a rien d’anodin. 
                        Des études montrent que limiter ses objectifs booste la productivité et réduit le stress. <br />
                        <br />✅ Plus de clarté 
                        <br />✅ Plus de satisfaction 
                        <br />✅ Moins de stress 
                    </p>
                    <p className='big-text'> Une méthode qui s’adapte à vous. </p>
                    <p>
                    Que vous soyez étudiant, entrepreneur ou salarié, notre système vous aide à rester productif sans sacrifier votre bien-être.
                    Plus besoin de lutter contre la procrastination : avec notre approche, chaque journée devient une victoire.
                    </p>
                </div>

                <div className="text-center mt-4">
                    <button className="btn primary-cta-btn btn-lg">Essayez maintenant</button>
                </div>

            </div>
        </div>
    );
}

export default BlocTwo;
