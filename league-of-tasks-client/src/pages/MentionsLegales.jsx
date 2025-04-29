import React from "react";
import { Container } from "react-bootstrap";
import "./Legal.css";

const MentionsLegales = () => {
  return (
    <Container className="legal-page">
      <h1>Mentions légales</h1>

      <section>
        <h2>Éditeur du site</h2>
        <p>
          Ce site est édité par : <strong>League of Tasks</strong><br />
          Email : contact@leagueoftasks.com<br />
          Téléphone : 0667557228<br />
        </p>
      </section>

      <section>
        <h2>Responsable de la publication</h2>
        <p>
          Sullivan Travers – contact@leagueoftasks.com
        </p>
      </section>

      <section>
        <h2>Hébergement</h2>
        <p>
        Hébergeur : 02switch<br />
        Adresse : 222-224 Boulevard Gustave Flaubert,<br /> 63000 Clermont-Ferrand, France<br />
        Téléphone : 04 44 44 60 40
        </p>
      </section>

      <section>
        <h2>Propriété intellectuelle</h2>
        <p>
          Les contenus de ce site sont la propriété exclusive de League of Tasks. Toute reproduction ou
          diffusion sans autorisation est interdite.
        </p>
      </section>

      <section>
        <h2>Données personnelles</h2>
        <p>
          Ce site collecte uniquement les données nécessaires au bon fonctionnement du service (formulaire de
          contact, compte utilisateur, statistiques anonymes).  
          Conformément au RGPD, vous pouvez demander à consulter, modifier ou supprimer vos données à
          l'adresse suivante : contact@leagueoftasks.com
        </p>
      </section>
    </Container>
  );
};

export default MentionsLegales;
