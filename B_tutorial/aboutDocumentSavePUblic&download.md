**Exact steps:**

1. **Form (Blade):**

   ```html
   <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
     @csrf
     <input type="file" name="file">
     <button type="submit">Upload</button>
   </form>
   ```

2. **Controller (store method):**

   ```php
   public function store(Request $request)
   {
       $path = $request->file('file')->store('documents', 'public');
       // → stores in storage/app/public/documents/filename.ext

       Document::create([
         'title' => $request->input('title'),
         'path'  => $path,       // e.g. "documents/abc123.pdf"
         // any other columns…
       ]);
   }
   ```

3. **Database:**

   * Have a `documents` table with a `path` column (string).
   * Save exactly the `$path` returned by `store()`.

4. **Make files publicly accessible:**

   ```bash
   php artisan storage:link
   ```

   → This creates `public/storage` pointing to `storage/app/public`.

5. **Showing/Downloading:**

   * URL to view/download:

     ```php
     <a href="{{ asset('storage/' . $document->path) }}" target="_blank">View/Download</a>
     ```

6. **Folder structure:**

   ```
   project_root/
   ├─ storage/app/public/documents/…      ← actual files
   ├─ public/storage/documents/…          ← symlinked
   └─ database/
       └─ migrations, seeders, etc.
   ```
---
---
---
---
---

That’s it. When you upload, Laravel puts the file in `storage/app/public/documents`, you save `"documents/yourfile.ext"` to the DB, and access it at `public/storage/documents/yourfile.ext`.
