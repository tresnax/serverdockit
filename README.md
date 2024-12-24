# ServerDockit (Server with Docker Toolkit)

- [Deskripsi Proyek (ID)](#deskripsi-proyek)
- [Project Description (EN)](#project-description)


## Deskripsi Proyek

Aplikasi ini terdiri dari beberapa komponen yang diatur menggunakan Docker untuk menyediakan lingkungan pengembangan yang terisolasi dan mudah dikelola. Aplikasi ini mencakup layanan web, database, serta sistem monitoring menggunakan Prometheus dan Grafana.

## Struktur Direktori

```
ServerDockit/
├── .gitignore
├── Vagrantfile
├── ansible/
│   ├── inventory.ini
│   └── setup-server.yaml
├── monitoring/
│   ├── config/
│   │   ├── grafana-dashboard.yaml
│   │   └── grafana-datasource.yaml
│   ├── dashboards/
│   └── docker-compose.yaml
└── webapps/
    ├── docker-compose.yaml
    ├── nginx/
    │   └── apps.conf
    └── www/
        ├── Dockerfile
        └── index.php
```

- `.env`: File konfigurasi lingkungan.
- `.gitignore`: File untuk mengabaikan file dan direktori tertentu dalam kontrol versi Git.
- `Vagrantfile`: File konfigurasi untuk Vagrant yang digunakan untuk membuat dan mengelola mesin virtual.
- `ansible/`: Direktori yang berisi skrip Ansible untuk mengatur server.
  - `inventory.ini`: File inventaris Ansible.
  - `setup-server.yaml`: Playbook Ansible untuk mengatur server.
- `monitoring/`: Direktori yang berisi konfigurasi untuk sistem pemantauan.
  - `config/`: Direktori yang berisi konfigurasi untuk Grafana dan Prometheus.
    - `grafana-dashboard.yaml`: Konfigurasi dashboard Grafana.
    - `grafana-datasource.yaml`: Konfigurasi datasource Grafana.
    - `prometheus.yml`: Konfigurasi Prometheus.
  - `dashboards/`: Direktori yang berisi dashboard Grafana dalam format JSON.
  - `docker-compose.yaml`: File Docker Compose untuk mengatur layanan pemantauan.
- `webapps/`: Direktori yang berisi aplikasi web.
  - `docker-compose.yaml`: File Docker Compose untuk mengatur layanan web.
  - `nginx/`: Direktori yang berisi konfigurasi Nginx.
    - `apps.conf`: Konfigurasi Nginx untuk load balancing.
  - `www/`: Direktori yang berisi aplikasi web.
    - `Dockerfile`: File Docker untuk membangun image aplikasi web.
    - `index.php`: File PHP yang menampilkan informasi hostname dan alamat IP server.

## Struktur Direktori Setelah Deploy

```
/var/www/
├── .env
├── webapps/
│   ├── www/
│   │   └── index.php
│   ├── nginx/
│   │   └── apps.conf
│   └── docker-compose.yaml
└── monitoring/
    ├── config/
    │   ├── grafana-dashboard.yaml
    │   └── grafana-datasource.yaml
    ├── prometheus.yml
    └── docker-compose.yaml
```
- `/var/www/.env`: File konfigurasi lingkungan.
- `/var/www/webapps/`: Direktori yang berisi file aplikasi web.
  - `www/`: Direktori yang berisi file aplikasi web.
    - `index.php`: File PHP yang menampilkan informasi hostname dan alamat IP server.
  - `nginx/`: Direktori yang berisi konfigurasi Nginx.
    - `apps.conf`: Konfigurasi Nginx untuk load balancing.
  - `docker-compose.yaml`: File Docker Compose untuk mengatur layanan web.
- `/var/www/monitoring/`: Direktori yang berisi konfigurasi sistem pemantauan.
  - `config/`: Direktori yang berisi konfigurasi untuk Grafana dan Prometheus.
    - `grafana-dashboard.yaml`: Konfigurasi dashboard Grafana.
    - `grafana-datasource.yaml`: Konfigurasi datasource Grafana.
  - `prometheus.yml`: Konfigurasi Prometheus.
  - `docker-compose.yaml`: File Docker Compose untuk mengatur layanan pemantauan.

## Layanan

### Webapps

- **nginx**: Digunakan sebagai reverse proxy dan load balancer.
- **apps**: Aplikasi web sederhana yang menampilkan informasi hostname dan alamat IP server.
- **db.apps**: Database yang digunakan oleh aplikasi web.

### Monitoring

- **grafana-monitor**: Digunakan untuk visualisasi data pemantauan.
- **prometheus**: Digunakan untuk mengumpulkan dan menyimpan metrik pemantauan.
- **node-exporter**: Mengumpulkan metrik dari sistem operasi.
- **docker-exporter**: Mengumpulkan metrik dari container Docker.

## Cara Menggunakan

1. **Setup Vagrant (optional)**:
   - Jalankan `ssh-keygen` pada komputer dan sesuaikan `id_ed25519.pub` pada **Vagrantfile** sesuai dengan key yang dibuat.
   - Jalankan `vagrant up` untuk membuat dan mengkonfigurasi mesin virtual.

2. **Setup Ansible**:
   - Sesuaikan informasi Server, DB Password dan Grafana Password pada `ansible/inventory.ini`
   - Jalankan perintah `ansible-playbook -i ansible/inventory.ini ansible/setup-server.yaml` untuk menginstal Docker, dan mengatur firewall.
   - Deployment akan dijalankan langsung oleh ansible setelah installasi docker engine selesai.
   - Aplikasi akan dideploy menggunakan Docker Compose dengan mengambil env dari `/var/www/.env`

3. **Deploy Aplikasi (Manual)**:
   - Aplikasi web dan sistem pemantauan akan dideploy menggunakan Docker Compose.
   - Buat file .env pada directory `/var/www/` dan isikan variabel dengan `DB_PASS` dan `GRAF_PASS`
   - Deploy webapps dengan perintah `docker-compose --env-file /var/www/.env -f /var/www/webapps/docker-compose.yaml up -d`
   - Deploy monitoring dengan perintah `docker-compose --env-file /var/www/.env -f /var/www/monitoring/docker-compose.yaml up -d`

4. **Akses Aplikasi**:
   - Aplikasi web dapat diakses melalui port 80.
   - Dashboard Grafana dapat diakses melalui port 3000 dengan username admin dan password sesuai .env.

Dengan struktur ini, aplikasi Anda dapat dengan mudah dikelola dan dipantau dalam lingkungan yang terisolasi.

## Project Description

This application consists of several components managed using Docker to provide an isolated and easily manageable development environment. The application includes web services, a database, and a monitoring system using Prometheus and Grafana.

## Directory Structure

```
ServerDockit/
├── .gitignore
├── Vagrantfile
├── ansible/
│   ├── inventory.ini
│   └── setup-server.yaml
├── monitoring/
│   ├── config/
│   │   ├── grafana-dashboard.yaml
│   │   └── grafana-datasource.yaml
│   ├── dashboards/
│   └── docker-compose.yaml
└── webapps/
    ├── docker-compose.yaml
    ├── nginx/
    │   └── apps.conf
    └── www/
        ├── Dockerfile
        └── index.php
```

- `.env`: Environment configuration file.
- `.gitignore`: File to ignore certain files and directories in Git version control.
- `Vagrantfile`: Configuration file for Vagrant used to create and manage virtual machines.
- `ansible/`: Directory containing Ansible scripts to configure the server.
  - `inventory.ini`: Ansible inventory file.
  - `setup-server.yaml`: Ansible playbook to configure the server.
- `monitoring/`: Directory containing configurations for the monitoring system.
  - `config/`: Directory containing configurations for Grafana and Prometheus.
    - `grafana-dashboard.yaml`: Grafana dashboard configuration.
    - `grafana-datasource.yaml`: Grafana datasource configuration.
    - `prometheus.yml`: Prometheus configuration.
  - `dashboards/`: Directory containing Grafana dashboards in JSON format.
  - `docker-compose.yaml`: Docker Compose file to manage monitoring services.
- `webapps/`: Directory containing the web application.
  - `docker-compose.yaml`: Docker Compose file to manage web services.
  - `nginx/`: Directory containing Nginx configuration.
    - `apps.conf`: Nginx configuration for load balancing.
  - `www/`: Directory containing the web application.
    - `Dockerfile`: Docker file to build the web application image.
    - `index.php`: PHP file displaying the server's hostname and IP address.

## Directory Structure After Deployment

```
/var/www/
├── .env
├── webapps/
│   ├── www/
│   │   └── index.php
│   ├── nginx/
│   │   └── apps.conf
│   └── docker-compose.yaml
└── monitoring/
    ├── config/
    │   ├── grafana-dashboard.yaml
    │   └── grafana-datasource.yaml
    ├── prometheus.yml
    └── docker-compose.yaml
```
- `/var/www/.env`: Environment configuration file.
- `/var/www/webapps/`: Directory containing the web application files.
  - `www/`: Directory containing the web application files.
    - `index.php`: PHP file displaying the server's hostname and IP address.
  - `nginx/`: Directory containing Nginx configuration.
    - `apps.conf`: Nginx configuration for load balancing.
  - `docker-compose.yaml`: Docker Compose file to manage web services.
- `/var/www/monitoring/`: Directory containing monitoring system configurations.
  - `config/`: Directory containing configurations for Grafana and Prometheus.
    - `grafana-dashboard.yaml`: Grafana dashboard configuration.
    - `grafana-datasource.yaml`: Grafana datasource configuration.
  - `prometheus.yml`: Prometheus configuration.
  - `docker-compose.yaml`: Docker Compose file to manage monitoring services.

## Services

### Webapps

- **nginx**: Used as a reverse proxy and load balancer.
- **apps**: A simple web application displaying the server's hostname and IP address.
- **db.apps**: Database used by the web application.

### Monitoring

- **grafana-monitor**: Used for monitoring data visualization.
- **prometheus**: Used to collect and store monitoring metrics.
- **node-exporter**: Collects metrics from the operating system.
- **docker-exporter**: Collects metrics from Docker containers.

## Usage

1. **Setup Vagrant (optional)**:
   - Run `ssh-keygen` on your computer and adjust `id_ed25519.pub` in the **Vagrantfile** according to the generated key.
   - Run `vagrant up` to create and configure the virtual machine.

2. **Setup Ansible**:
   - Adjust the Server information, DB Password, and Grafana Password in `ansible/inventory.ini`.
   - Run the command `ansible-playbook -i ansible/inventory.ini ansible/setup-server.yaml` to install Docker and configure the firewall.
   - Deployment will be executed directly by Ansible after the Docker engine installation is complete.
   - The application will be deployed using Docker Compose, taking the environment variables from `/var/www/.env`.

3. **Deploy Application (Manual)**:
   - The web application and monitoring system will be deployed using Docker Compose.
   - Create a `.env` file in the `/var/www/` directory and fill in the variables with `DB_PASS` and `GRAF_PASS`.
   - Deploy webapps with the command `docker-compose --env-file /var/www/.env -f /var/www/webapps/docker-compose.yaml up -d`.
   - Deploy monitoring with the command `docker-compose --env-file /var/www/.env -f /var/www/monitoring/docker-compose.yaml up -d`.

4. **Access Application**:
   - The web application can be accessed through port 80.
   - The Grafana dashboard can be accessed through port 3000 with the username `admin` and the password specified in `.env`.

With this structure, your application can be easily managed and monitored in an isolated environment.
