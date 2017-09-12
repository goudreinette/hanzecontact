/*
	Dit bestand bevat wat hulp functies in javascript 
 */


/*
	Deze functie vraag de vraag 'message' aan de bruiker.
	Als de gebruiker positief bevestigd, wordt de browser doorverwezen
	naar de variabele 'url'.
 */
function confirmAction(message, url) {
	if(confirm(message) == true) {
		document.location.href = url;
	}
}