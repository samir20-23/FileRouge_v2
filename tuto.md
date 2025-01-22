

### **1. Clone the Project**
```bash
git clone https://github.com/samir20-23/FileRouge_v2.git
cd FileRouge_v2
```

---

### **2. Install Laravel Dependencies**
```bash
composer install
```
<!--. . . . . . . tutorials  -->
---

### **3. Configure Database**
Edit the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

---

### **4. Generate Application Key**
```bash
php artisan key:generate
```

---

### **5. Run Migrations**
```bash
php artisan migrate
```

---

### **6. Install Frontend Dependencies**
```bash
npm install
npm run dev
```

---

### **7. Serve the Application**
```bash
php artisan serve
```

---

Now, you can access your application by visiting `http://localhost:8000`.