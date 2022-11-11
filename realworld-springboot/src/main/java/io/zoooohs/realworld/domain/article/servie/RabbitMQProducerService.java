package io.zoooohs.realworld.domain.article.servie;

public interface RabbitMQProducerService {
    void send(String body);
}
