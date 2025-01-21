public class lat7_project {
    public static void main(String[] args) {
        
        System.out.println("Perulangan segitiga bintang");
        
        for (int i = 1; i <= 5; i++) {
            for (int j = 1; j <= i; j++) {
                System.out.print("* ");
            }
            System.out.println();
            }


            System.out.println("Perulangan segitiga bintang terbalik");
            
            for (int i = 5; i >= 1; i--) {
                for (int j = 1; j <= i; j++) {
                    System.out.print("* ");
                }
                System.out.println();
        }

        
        
            for (int i = 1; i <= 2; i++) {
                for (int j = 1; j <= 3; j++) {
                    System.out.println("KD "+i + "," + j);
                }   
                System.out.println();
            }
        } 
    
}
