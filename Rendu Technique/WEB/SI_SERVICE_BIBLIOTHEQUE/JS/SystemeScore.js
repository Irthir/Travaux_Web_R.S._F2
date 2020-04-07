
function CreatVarDebut()
{
    DateDebut = Date.now();
    DateMelissandre = new Date; //Melissandre mange les cookies si on les laisse trainer trop longtemps.
    DateMelissandre.setMonth(DateMelissandre.getMonth()+1); //Mise en place de la date de fin du cookie dans un mois. Même si Melissandre attend plutôt 15 minutes max pour les manger en général.
    DateMelissandre=DateMelissandre.toUTCString();
    console.log("Date Debut = "+DateDebut);
    document.cookie="date_debut="+DateDebut+"; expires="+DateMelissandre+"; path=/";
    console.log(DateMelissandre);
}

function CreatVarFin()
{
    DateFin = Date.now();
    DateMelissandre = new Date; //Melissandre mange les cookies si on les laisse trainer trop longtemps.
    DateMelissandre.setMonth(DateMelissandre.getMonth()+1); //Mise en place de la date de fin du cookie dans un mois. Même si Melissandree attend plutôt 15 minutes max pour les manger en général.
    DateMelissandre=DateMelissandre.toUTCString();
    console.log("Date Fin = "+DateFin);
    document.cookie="date_fin="+DateFin+"; expires="+DateMelissandre+"; path=/";
    console.log(DateMelissandre);
}

function ValeurCookie()
//BUT : Créer les cookies qui vont être récupérés par le php.
//ENTREE : Les deux cookies date_debut et date_fin qui doivent déjà être créés.
//SORTIE : 4 cookies créés pour la gestion du score.
{
    if (document.cookie.length>0)
    {
        var tablecookie = document.cookie.split(';');
        var nomdebut = "date_debut=";
        var nomfin = "date_fin=";
        var datedebut = "";
        var datefin = "";
        for (var nI = 0 ; nI < tablecookie.length; nI++)
        {
            if(tablecookie[nI].indexOf(nomdebut)!=-1)
            {
                datedebut=tablecookie[nI].substring(nomdebut.length+tablecookie[nI].indexOf(nomdebut),tablecookie[nI].length); 
            }
            if(tablecookie[nI].indexOf(nomfin)!=-1)
            {
                datefin=tablecookie[nI].substring(nomfin.length+tablecookie[nI].indexOf(nomfin),tablecookie[nI].length);     
            }
        }
        if (parseInt(datedebut)!=NaN && parseInt(datefin)!=NaN)
        {
            //Mise en place des données à mettre dans les cookies.
            var Score = parseInt(datefin)-parseInt(datedebut); //Création de la variable score qui sera stockée dans un cookie et récupérer en php puis sql.
            var Minutes = Math.floor(Score/60000);
            var Secondes = Math.floor((Score % 60000)/1000);
            var Millisecondes = (Score % 1000);
            console.log ("Score = ",Score," Minutes = ",Minutes," Secondes = ",Secondes," Millisecondes = ",Millisecondes);

            //Création des cookies.
            DateMelissandre = new Date; //Melissandre mange les cookies si on les laisse trainer trop longtemps.
            DateMelissandre.setMonth(DateMelissandre.getMonth()+1); //Mise en place de la date de fin du cookie dans un mois. Même si Melissance attend plutôt 15 minutes max pour les manger en général.
            DateMelissandre=DateMelissandre.toUTCString();
            document.cookie="Score="+Score+"; expires="+DateMelissandre+"; path=/";
            document.cookie="Minutes="+Minutes+"; expires="+DateMelissandre+"; path=/";
            document.cookie="Secondes="+Secondes+"; expires="+DateMelissandre+"; path=/";
            document.cookie="Millisecondes="+Millisecondes+"; expires="+DateMelissandre+"; path=/";


            document.getElementById('VictoireForm').submit();
        }
        else
        {
            console.log("Erreur les cookies ne sont pas des nombres.");
        }
    }
    else
    {
      console.log("Erreur aucun cookie.");
    }
}