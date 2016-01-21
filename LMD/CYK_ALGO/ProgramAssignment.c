#include<stdio.h>
#include<string.h>
int main()
{
	int array3D[50][50][50],test;
	int length,x_axis,r,y_axis,z_axis,start,p,q,rule_no,e;
	int f,g,h,check,y,z,a,kranti;
	char string[51],Production_rule[51],lhs[50][1],rhs[50][2],word[50];
	/*----------------------------------------------*/
	printf("ENTER THE NO OF TEST CASES\n");
	scanf("%d",&test);
	while(test--)
	{
		printf("ENTER THE STRING\n");
		scanf("%s",string);         //STRING IS SCANNED
		length=strlen(string);
		start=1;
		for(f=0;f<length;f++)
		{
			word[start]=string[f];start++;
		}
		/*--------------------------------------------*/
		r=1;
		Production_rule[0]='p';
		printf("ENTER THE GRAMMAR IN CHOMSKY NORMAL FORMAL\n");
		printf("PUT A '.' IN THE NEW LINE TO SHOW \n");
		while(Production_rule[0]!='.')
		{
			memset(Production_rule,0,50);
			scanf("%s",Production_rule);
			//SET OF RULES SCANNED
			lhs[r][0]=Production_rule[0];
			rhs[r][0]=Production_rule[3];
			if(strlen(Production_rule)==5)
				rhs[r][1]=Production_rule[4];
			r++;
		}
		printf("------------------------------------\n");
		printf("YOU HAVE ENTERED THE FOLLOWING PRODUCTION RULE\n");
		printf("--------------------------------------------\n");
		for(y=1;y<r-1;y++)
		{
			printf("%c->",lhs[y][0]);
			printf("%c%c\n",rhs[y][0],rhs[y][1]);
		}
		printf("----------------------------------------\n");
		/*---------------------------------------------------*/

		for(x_axis=1;x_axis<=length;x_axis++)
		{
			for(y_axis=1;y_axis<=length;y_axis++)               // 3D array is initialized to zero....
			{
				for(z_axis=1;z_axis<r;z_axis++)
				{
					array3D[x_axis][y_axis][z_axis]=0;}}}
		/*-----------------------------------------------*/
		for(p=1;p<=length;p++)
		{
			for(q=1;q<r;q++)
			{
				if(word[p]==rhs[q][0])
				{
					array3D[1][p][q]=1;          //y-z filling for x=1 i.e level=1
					//printf("p=%d q=%d\n",p,q);
				}
			}
		}
		//printf("-------------------------------------\n");
		//printf("%d............\n",len);
		/*--------------------------------------------------*/

		for(f=2;f<=length;f++)      //each length...last for loop did for singles...
		{
			kranti=length+1-f;
			for(g=1;g<=kranti;g++)   //length f will be done from 1 to f...to n-f+1 to n...
			{
				//printf("******************\n");
				for(h=1;h<=f-1;h++)      //no.of parts of a string....
				{
					for(e=1;e<r;e++)      //each production rule
					{
						for(z=1;z<r;z++)
						{
							//printf("h=%d g=%d e=%d array[h][g][e]=%d array[f-h][g+h][z]=%d\n",h,g,e,array[h][g][e],array[f-h][g+h][z]);

							if(array3D[h][g][e]==1 && array3D[f-h][g+h][z]==1)
							{
								//printf("h=%d g=%d e=%d\n",h,g,e);
								for(a=1;a<r;a++)//all production rule 
								{
									if(rhs[a][0]==lhs[e][0] && rhs[a][1]==lhs[z][0] )
										array3D[f][g][a]=1;
								}
							}
						}
					}
				}
			}
		}
		/*--------------------------------------------------*/
		check=55;
		for(rule_no=1;rule_no<r;rule_no++)
		{
			if(array3D[length][1][rule_no]==1)
			{check=100;break;}
		}
		if(check==100)
		{
			printf("..YES.. THE STRING CAN BE OBTAINED FROM THE FOLLOWING GRAMMAR\n");
			printf("---------------------------------\n");
		}
		else
		{printf("..NO.. THE STRING CAN'T BE OBTAINED FROM THE FOLLOWING GRAMMAR\n");
			printf("---------------------------------\n");
		}
	}
	return 0;
}
