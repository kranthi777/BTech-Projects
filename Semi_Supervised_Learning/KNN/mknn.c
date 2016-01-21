#include<stdio.h>
#include<stdlib.h>
#include<math.h>
int randomn[50]={-1};
int knear=3;
void MKNN(float distance[][2]);
void GenrateRandNo(int base)
{       
	int i=0,j;
	while(1)
	{
		int r = rand() % 50 + base;
		for(j=0;j<i;j++)
		{
			if(randomn[j]==r)
				break;
			else if(j==i-1)
			{randomn[i]=r;i++;}
			else
				continue;

		}
		if(i==0)
		{
			randomn[0]=r;
			i++;
		}
		if(i==50)
			break;

	}
}
void MKNN(float normdistance[][2])
{ 
	int inc1,inc2,inc3,inc4,basel=0;
	float warr[knear][2],lowdist,highdist,class1=0,class2=0,class3=0,accuracy=0;
	for(inc1=0;inc1<30;inc1++)
	{

		if(inc1==30)
		{
			printf(" the accuracy is %f",accuracy/30);
			break; 
		}
		inc3=1;
		class1=0,class2=0,class3=0;
		warr[0][0]=1;
		warr[0][1]=normdistance[basel][1];
		warr[knear-1][0]=0;
		warr[knear-1][1]=normdistance[basel+knear-1][1];
		lowdist=normdistance[basel][0];
		highdist=normdistance[knear+basel-1][0];
		for(inc2=basel+1;inc2<knear+basel-1;inc2++)
		{

			warr[inc3][0]=(highdist-normdistance[inc2][0])/(highdist-lowdist);    
			warr[inc3][1]=normdistance[inc2][1];
			inc3++;   

		}
		for(inc4=0;inc4<knear;inc4++)
		{ 

			if(warr[inc4][1]==1)
				class1=class1+warr[inc4][0];
			if(warr[inc4][1]==2)
				class2=class2+warr[inc4][0];
			if(warr[inc4][1]==3)
				class3=class3+warr[inc4][0];                     
		}

		if(class1>=class2&&class1>=class3)
		{
			printf("class1 \n");
			if(inc1>=0&&inc1<10)
				accuracy++;
		} 
		if(class2>class1&&class2>class3)
		{	
			printf("class2 \n");
			if(inc1>=10&&inc1<20)
				accuracy++;
		}
		if(class3>class2&&class3>class1)
		{

			printf("class3 \n");
			if(inc1>=20&&inc1<30)
				accuracy++;

		}
		basel=basel+120;

	}
	//        printf(" the accuracy is %f",accuracy/30);
	return;
}
void L2NORM(float train[][5],float test[][5])
{
	float distance[3600][2];
	int i,j,k=0,l;
	float distf1,distf2,distf3,distf4;
	for(i=0;i<30;i++)
	{
		for(j=0;j<120;j++)
		{
			l=0;
			distf1=pow(train[j][l]-test[i][l],2);
			distf2=pow(train[j][l+1]-test[i][l+1],2);
			distf3=pow(train[j][l+2]-test[i][l+2],2);
			distf4=pow(train[j][l+3]-test[i][l+3],2);
			distance[k][0]=sqrt(distf1+distf2+distf3+distf4);
			distance[k][1]=train[j][l+4];
			k++;
		}
	}
	float temp,base=0;
	for(k=0;k<30;k++)
	{
		for(i=0+base;i<120+base;i++)
			for(j=0+base;j<120+base;j++)
				if(distance[j][0]>distance[j+1][0])
				{ 
					temp=distance[j][0];distance[j][0]=distance[j+1][0];distance[j+1][0]=temp;
					temp=distance[j][1];distance[j][1]=distance[j+1][1];distance[j+1][1]=temp;
				}
		base=base+120;
	}
	MKNN(distance); 
}

int main()
{      
	/*Reading the dataset from an input  file*/
	int i,j;                               
	float data[150][5];  
	FILE *file1 = fopen("filename","r");
	for(i=0;i<150;i++)
	{
		for(j=0;j<5;j++)
		{
			fscanf(file1,"%f",&data[i][j]);
		}
	}
	/*Dividing the dataset into training and testing*/
	float test[30][5], train[120][5];
	//function for generating unique random number
	int base=0,k,base1=0,trainv=0,testv=0;
	for(j=0;j<3;j++)
	{
		GenrateRandNo(base); 
		//	for(k=0;k<50;k++)
		//	printf("%d\n",randomn[k]);
		for(i=0+base1;i<50+base1;i++)
		{
			if((i>=0&&i<40)||(i>=50&&i<90)||(i>=100&&i<140))
			{
				for(k=0;k<5;k++)
					train[trainv][k]=data[randomn[i-base1]][k];
				trainv++;
			}
			else
			{
				for(k=0;k<5;k++)
					test[testv][k]=data[randomn[i-base1]][k];
				testv++;
			}                                
		}
		base=base+50;
		base1=base1+50;
	}        
	L2NORM(train,test);
	return 0;
}
