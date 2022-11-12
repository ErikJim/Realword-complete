FROM openjdk:11
EXPOSE 8080
RUN mkdir -p /app/
ADD build/libs/realworld-0.0.1-SNAPSHOT.jar /app/realworld-0.0.1-SNAPSHOT.jar
ENTRYPOINT ["java", "-jar", "/app/realworld-0.0.1-SNAPSHOT.jar"]