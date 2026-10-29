pipeline {
  agent any
  stages {
    stage('Build and Deploy') {
      steps {
        sh 'docker compose -f docker-compose-part2.yml down || true'
        sh 'docker compose -f docker-compose-part2.yml up -d'
      }
    }
  }
  post {
    always {
      emailext(
        subject: "Build ${currentBuild.currentResult}: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
        body: "Result: ${currentBuild.currentResult}\nJob: ${env.JOB_NAME}\nBuild number: ${env.BUILD_NUMBER}\nDetails: ${env.BUILD_URL}",
        recipientProviders: [developers(), requestor()]
      )
    }
  }
}
