# Private proposal review

This standalone WordPress preview lives under the physical directory `/chat/comercial/evenly/`. Only the dedicated preview branch triggers its FTPS workflow. The workflow lints PHP and uploads the files in `public/` to that single directory. There is no theme rebuild or change to public navigation.

## Runtime and configuration

Requires the existing WordPress installation, its theme assets, PHP sessions, OpenSSL, MySQL and the site's existing WordPress mail transport. The authenticated document uses the active theme's contact email for preview notifications. All submissions are test records. The recipient field on the form identifies the respondent and is never a notification destination.

The private document is uploaded directly over HTTPS to its WordPress host in a signed envelope encrypted for this installation. Keep all release payloads, including encrypted copies, outside Git. The corresponding document and a bcrypt verifier are stored in a non-autoloaded WordPress option only after verification. Commercial copy, the access code, signing credentials and readable client records must stay outside this repository. Initialisation removes the temporary server-side decryption key and disables the public-key setup endpoint. Preserve the WordPress database across deployments. A fresh independent installation requires its own sealed release.

The PHP session has a 30-minute absolute lifetime and a secure, HTTP-only, same-site cookie. A four-digit code is intended for convenient private review. Sign-in is limited both by session and by a short-lived keyed network identifier. All proposal responses are private, non-cacheable and excluded from indexing.

## Inspect records on the host

Use a trusted WordPress administrator shell at the site root. The following read-only command lists receipts and notification status. Use the site's normal database tools to inspect a particular receipt's message or terms snapshot when needed.

```sh
table="$(wp db prefix)sera_chat_preview_records"
wp db query "SELECT id, kind, proposal_id, version, created_utc, notify_status FROM \`$table\` ORDER BY created_utc DESC LIMIT 20"
```

The acceptance key is unique per test email and document version. A question has its own submission key and never marks the proposal as accepted. Notification is attempted after the database write. A failed send remains pending and can be retried on the next authenticated visit after ten minutes. A successful mail transport handoff is recorded as sent.

For a browser review, enter the privately supplied code, inspect the sprint, and submit either response. Lock the proposal using the top-right button. Use a new private window to check the anonymous gate. Review-mode receipts are separate from any future client-facing release. Removal of the preview can be limited to this physical directory. Retain any test records only for as long as the owner needs them.
