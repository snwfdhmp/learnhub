#include <stdio.h>
#include <string.h>

//ce code a pour but d'illustrer l'usage de argc et argv (parametres du main)

// on ne gère ici que les additions et soustractions d'entiers

int verification(char *ch,int L)
{
int i=0;
while(i<L && ch[i]>=48 && ch[i]<=57) i++; 
if (i==L) return 1;
else return -1;
}



int atoi(char *ch,int L)
{
int i;
int V=0;
for(i=0;i<L;i++)
	{	
	V=10*V+ch[i]-48;
	}

return V;
}



int main(int argc, char *argv[])
{
// ce code considere que argc sera paire
//RAPPEL :  ./calc 12 + 5  produit argc=4
//          ./calc 12 + 5 - 7 produit argc=6


char chaine[10];
int reponse,valeur,resultat=0;
int i,L,j;

printf("\n argc=%d",argc);
for(i=0;i<argc;i++)
	printf("\n argv[%d]=\"%s\"",i,argv[i]);
printf("\n\n");

for(j=1;j<argc;j+=2)
{
	L=strlen(argv[j]);
	reponse = verification(argv[j],L);
	if (reponse==1) 
		{
		printf("\n La chaine est OK, on va la convertir... ");
		valeur= atoi(argv[j],L);
		printf("\n La valeur numerique de la chaine est : %d ",valeur);
		}
	else 
		{
		printf("\n --> LA commande saisie est  incorrecte !!!!!!! \n");	
		return -1;
		}


	if (j==1) resultat=valeur;
	else //1
	{
	if ( strlen(argv[j-1])==1)
		{
		switch(argv[j-1][0])
			{
			case '+' : resultat+=valeur;break;
			case '-' : resultat-=valeur;break;
			};
	}
	else
		{
		printf("\n --> saisie incorrecte !!!!!!!!!!!!!!!! \n");	
		return -1;
		}
	}//else 1

}//for


printf("\n\n>>>resultat = %d\n\n\n	",resultat);
return 0;
}




