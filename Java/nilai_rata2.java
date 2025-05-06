import java.util.Scanner;

public class nilai_rata2 {
    public static void main(String[] args) {
        System.out.println("Nilai rata2 ");

        Scanner InputUser  = new Scanner(System.in);

        System.out.print( "Masukkan nilai Tugas : ");
        double tugas= InputUser.nextDouble();
        System.out.print( "Masukkan nilai UTS : ");
        double uts= InputUser.nextDouble();
        System.out.print( "Masukkan nilai UAS : ");
        double uas= InputUser.nextDouble();

        double average = (tugas + uts + uas) / 3;

        System.out.print("Nilai rata-rata : " + average);

        InputUser.close();
    }
}
 