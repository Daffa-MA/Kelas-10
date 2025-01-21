import java.util.Scanner;

public class lat6 {
    public static void main(String[] args) {
        System.out.println("Percabangan nilai");

        Scanner InputUser  = new Scanner(System.in);
        int nilai;

        while (true) {
            System.out.print("Masukkan nilai Anda : ");
            nilai = InputUser .nextInt();

            if (nilai >= 0 && nilai <= 100) {
                break;
            } else {
                System.out.println("Nilai harus berada dalam rentang 0-100. Silakan coba lagi.");
            }
        }

        if (nilai >= 80) {
            System.out.println("Nilai A");
        } else if (nilai >= 70) {
            System.out.println("Nilai B");
        } else if (nilai >= 60) {
            System.out.println("Nilai C");
        } else {
            System.out.println("Nilai D");
        }

        InputUser .close();
    }
}