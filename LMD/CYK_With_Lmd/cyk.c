#include<stdio.h>
#include<string.h>
int function(int level,int starting_col,int flag);
int array[101][101][101],r,lhs[100][1],rhs[100][2],temp=0,zero[500]={0},count=0;
char print[500];
int main()
{
	int len,i,j,k,p,q,u,e,f,g,h,flag=0,y,z,a,mm,t=1,ss,tt,uu,left,right;
	char word1[101],rule[100],word[100],store[100][100],start,new[100],last[100];
	printf("Please input the string\n");
	scanf("%s",word1);         
	len=strlen(word1);
	for(f=0;f<len;f++)
	{
		word[t]=word1[f];t++;
	}
	getchar();
	printf("please input the start symbol\n");
	scanf("%c",&start);
	printf("\n----------------------------------------\n");
	printf("please enter the production rules\n");
	r=1;rule[0]='p';
	while(rule[0]!='.')
	{
		memset(rule,0,100);
		scanf("%s",rule);
		lhs[r][0]=rule[0];
		rhs[r][0]=rule[3];
		if(strlen(rule)==5)
			rhs[r][1]=rule[4];
		r++;
	}
	for(i=1;i<=len;i++)
	{
		for(j=1;j<=len;j++)
		{
			for(k=1;k<r;k++)
			{
				array[i][j][k]=0;
			}
		}
	}
	for(p=1;p<=len;p++)
	{
		for(q=1;q<r;q++)
		{                                 //alphabets on y axis level on x axis and rules on z axis..............
			if(word[p]==rhs[q][0])
			{
				array[1][p][q]=1;     
			}
		}
	}
	for(f=2;f<=len;f++) 
	{
		mm=len+1-f;
		for(g=1;g<=mm;g++)  
		{
			for(h=1;h<=f-1;h++) 
			{
				for(e=1;e<r;e++)    
				{
					for(z=1;z<r;z++)
					{
						if(array[h][g][e]==1 && array[f-h][g+h][z]==1)
						{
							for(a=1;a<r;a++)
							{
								if(rhs[a][0]==lhs[e][0] && rhs[a][1]==lhs[z][0] )
									array[f][g][a]=1;
							}
						}
					}
				}
			}
		}
	}
	for(u=1;u<r;u++){
		if(array[len][1][u]==1 && lhs[u][0]==start)
		{
			flag=1;break;
		}
	}
	printf("\n--------------------------------\n");
	printf("OUTPUT\n");
	if(flag==1)
	{
		printf("yes\n");
	}
	else
		printf("no\n");
	//now print that cyk diagram...
	// firstly run on z axis corresponding to every y...
	//so innermost loop will be zz axis...then y axis then x-axis....
	//printf("Now printing CYK algorithm table\n");
	int level=1,col=1;

//	printf("\n.........Table for Left most derivative.......\n");
	for(ss=1;ss<level;ss++)
	{
		tt=1;
		while(store[ss][tt]!='#')
		{
			printf("%c",store[ss][tt]);
			tt++;
		}
		printf("\n");
	}
	printf("------------------------------------------\n");
	printf("left most derivative\n");
	int aa,bb,cc;


	for(ss=1;ss<len;ss++)  ///left part
	{
		tt=len-ss;
		for(aa=1;aa<r;aa++)//all elements of col1 0f level ss..//for all rules of z axis which is 1 for level i.e x=1 and y=1 i.e first 
		{
			if(array[ss][1][aa]==1)
			{
				for(bb=1;bb<r;bb++)//all elements of col(ss+1) of level length-ss..
				{
					// check wether level we can get from that level...
					if(array[tt][ss+1][bb]==1)
					{
						for(cc=1;cc<r;cc++)
						{
							if(array[len][1][cc]==1 && lhs[cc][0]==start)
							{


								if( lhs[aa][0]==rhs[cc][0] && lhs[bb][0]==rhs[cc][1])
								{
									if(ss!=1)
									{
										left=function(ss,1,0);
									}
									else
										left=5;
									if(tt!=1)
									{
										right=function(tt,ss+1,0);
									}
									else
										right=5;
									if(left==5 && right==5)
									{
										//				printf("%c %c \n",lhs[aa][0],lhs[bb][0]);
										temp=1;
										print[count]=lhs[aa][0];
										if(ss==1)
											zero[count]=1;
										count++;
										print[count]=lhs[bb][0];
										if(tt==1)
											zero[count]=1;
										count++;
										break;
									}
								}


							}
						}
					}
				}
			}

		}
	}
	printf("\n");

	int kk;
	for(kk=0;kk<count;kk++)
	{
		printf("%c ",print[kk]);
	}
	printf("\n");
	for(kk=0;kk<count;kk++)
	{
		printf("%d ",zero[kk]); 
	}
	if(flag==1){
		printf("\n======================================\n");
		printf("%c\n",start);
		int pair,ll,jj,last_c[100],new_c[100],ff,bbb;
		last[0]=print[count-2];
		last_c[0]=zero[count-2];
		last[1]=print[count-1];
		last_c[1]=zero[count-1];
		printf("%c%c\n",last[0],last[1]);
		pair=count/2;
		//printf("{%d}\n",pair);
		/////////////////////////////////////////////////////////////////////////////////////////
		for(ll=pair-1;ll>0;ll--)
		{
			int ppp,dd=1, vv=0,fag=0;
			///////////////////
			vv=0;fag=0;
			while(last_c[vv]!=0)
			{
				if(last_c[vv]==1)
				{
					last_c[vv]=2;
					fag=1;
					for(dd=1;dd<r;dd++)
					{
						if(lhs[dd][0]==last[vv] && rhs[dd][1]=='\0')
						{
							last[vv]=rhs[dd][0];
							break;
						}
					}
				}
				vv++;
			}
			/////////////////////
			if(fag==1)
			{
				ppp=0;
				while(last[ppp]!='\0')
				{
					new[ppp]=last[ppp];
					new_c[ppp]=last_c[ppp];
					printf("%c",last[ppp]);
					ppp++;
				}
				ll=ll+1;
				//printf("==%d==",ll);
			}
			else
			{
				ppp=0;
				while(last_c[ppp]!=0)
				{
					new[ppp]=last[ppp];
					new_c[ppp]=last_c[ppp];
					printf("%c",new[ppp]);
					ppp++;
				}
				new[ppp]=print[2*ll-2];
				new_c[ppp]=zero[2*ll-2];
				//printf("****%d**%d****",zero[2*ll-2],2*ll-2);
				printf("%c",new[ppp]);
				//printf("........%d...",new_c[ppp]);
				ppp++;
				new[ppp]=print[2*ll-1];
				new_c[ppp]=zero[2*ll-1];
				printf("%c",new[ppp]);
				//printf("----------%d----",new_c[ppp]);
				ppp++;
				bbb=ppp-1;
				while(last[bbb]!='\0')
				{
					new[ppp]=last[bbb];
					new_c[ppp]=last_c[ppp];
					printf("%c",new[ppp]);
					ppp++;
					bbb++;
				}
				for(ff=0;ff<ppp;ff++)
				{
					last[ff]=new[ff];
					last_c[ff]=new_c[ff];
				}
			}
			printf("\n");
		}}
	if(flag==1)
		printf("%s\n",word1);
	return 0;
}

int function(int level,int starting_col,int flag)
{
	int ss,tt,aa,bb,cc,left,right;
	if(temp==0)
	{
		for(ss=1;ss<level;ss++)  ///left part
		{
			tt=level-ss;
			for(aa=1;aa<r;aa++)//all elements of col1 0f level ss..//for all rules of z axis which is 1 for level i.e x=1 and y=1 i.e first part
			{
				if(array[ss][starting_col][aa]==1)
				{
					for(bb=1;bb<r;bb++)//all elements of col(ss+1) of level length-ss..
					{
						// check wether level we can get from that level...
						if(array[tt][ss+starting_col][bb]==1)
						{
							for(cc=1;cc<r;cc++)
							{
								if(array[level][starting_col][cc]==1)
								{


									if( lhs[aa][0]==rhs[cc][0] && lhs[bb][0]==rhs[cc][1])
									{
										if(ss!=1)
										{
											left=function(ss,starting_col,flag);
										}
										else
											left=5;
										if(tt!=1)
										{
											right=function(tt,ss+starting_col,flag);
										}
										else
											right=5;
										if(left==5 && right==5)
										{
											//					printf("%c %c \n",lhs[aa][0],lhs[bb][0]);
											print[count]=lhs[aa][0];
											count++;
											if(ss==1)
												zero[count-1]=1;
											print[count]=lhs[bb][0];
											count++;
											if(tt==1)
												zero[count-1]=1;


											return 5;
										}
										else
											return 0;
									}


								}
							}
						}
					}
				}

			}
		}
	}
}
