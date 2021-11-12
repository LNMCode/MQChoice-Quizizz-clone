import 'package:equatable/equatable.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';

abstract class WaitRoomEvent extends Equatable {
  const WaitRoomEvent();

  @override
  List<Object?> get props => [];
}

class WaitRoomEventConnected extends WaitRoomEvent {}