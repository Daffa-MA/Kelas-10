public class lat3 {
    public static void main(String[] args) {
        System.out.println("Operator Aritmatika");
        int a,b;

        double c;

        a = 10;
        b = 5;
        c = a + b;

        System.out.println("a + b: " + (a + b));
        System.out.println("a - b: " + (a - b));
        System.out.println("a * b: " + (a * b));
        System.out.println("a / b: " + (a / b));
        System.out.println("a % b: " + (a % b));
        System.out.println("a + b = " + c);
        c = a - b;
        System.out.println("a - b = " + c);
        c = a * b;
        System.out.println("a * b = " + c);
        c = a / b;
        System.out.println("a / b = " + c);
        c = a % b;
        System.out.println("a % b = " + c);
        c = (double) a / b;
        System.out.println("(double) a / b = " + c);
        c = (double) a + (double) b;
        System.out.println("(double) a + (double) b = " + c);
        c = (double) a - (double) b;
        System.out.println("(double) a - (double) b = " + c);
        c = (double) a * (double) b;
        System.out.println("(double) a * (double) b = " + c);
        c = (double) a / (double) b;
        System.out.println("(double) a / (double) b = " + c);
        c = (double) a % (double) b;
        System.out.println("(double) a % (double) b = " + c);
    }
}
