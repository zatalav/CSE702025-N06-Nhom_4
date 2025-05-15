#include<stdio.h>
void sapxep(int A[],int n){
	int k=0;
	for(int i=0;i<n-1;i++){
		for(int j=0;j<n-i-1;j++){
			if(A[j]<A[j+1]){
				int tmp=A[j];
				A[j]=A[j+1];
				A[j+1]=tmp;	
			}
		}
		k++;
		if(k==3){
			return;
		}
	}
}
int main(){
	int n;
	scanf("%d", &n);
	int A[n];
	for(int i=0;i<n;i++){
		scanf("%d", &A[i]); 
	}
	sapxep(A,n);
	for(int i=0;i<n;i++){
		printf("%d,", A[i]); 
	}
}
