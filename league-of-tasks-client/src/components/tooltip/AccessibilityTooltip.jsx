import { OverlayTrigger, Tooltip } from "react-bootstrap";
import "./AccessibilityTooltip.css"

export default function AccessibilityTooltip() {
  return (
    <OverlayTrigger
      placement="top"
      trigger={["hover", "focus", "click"]}
      overlay={
        <Tooltip id="tooltip-accessibility">
         <span className="span-green"> League of Tasks </span> est une application <span className="span-green"> inclusive.</span> <br /><br />
          Activez ces options pour une expérience adaptée à vos besoins, avec des <span className="span-green">tâches ajustées</span> selon vos paramètres d'accessibilité. <br /><br />
          <span className="span-green">Notre mission : </span>que chaque utilisateur ait la meilleur experience possible !
        </Tooltip>
      }
    >
      <span className="cursor-pointer text-muted ms-2">
        <i className="bi bi-info-circle"></i> {/* Icône Bootstrap */}
      </span>
    </OverlayTrigger>
  );
}
